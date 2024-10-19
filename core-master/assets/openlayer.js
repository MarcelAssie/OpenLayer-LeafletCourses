let layer =  new ol.layer.Vector({
            source: new ol.source.Vector(),
            style: new ol.style.Style({
                stroke: new ol.style.Stroke({
                    color: 'red',
                    width: 5,
                }),
            }),
        });
let map = new ol.Map({
    target: 'openlayer',
    view: new ol.View({
        center: ol.proj.fromLonLat([2.35, 48.85]),
        zoom: 13,
    }),
    layers: [
        new ol.layer.Tile({
            source: new ol.source.XYZ({
                url: 'https://tile.openstreetmap.org/{z}/{x}/{y}.png',
                maxZoom: 19,
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            }),
        }),
        new ol.layer.Tile({
            source: new ol.source.TileWMS({
                url: 'http://localhost:8080/geoserver/wms',
                params: {'LAYERS': 'lines', 'TILED': true},
            }),
        }),
    ],
});
map.addLayer(layer);


Vue.createApp({

    data() {
        return {
            topooh : "",
        };
    },
    mounted() {
        map.on('click', evt => {
            let viewResolution = map.getView().getResolution();
            console.log(viewResolution)
            let wmsSource = map.getLayers().item(1).getSource();
            let url = wmsSource.getFeatureInfoUrl(
                evt.coordinate,
                viewResolution,
                'EPSG:3857',
                {'INFO_FORMAT': 'application/json'}
            )
            if (url) {
                fetch(url)
                    .then(response => response.json())
                    .then(json => {
                        let features = new ol.format.GeoJSON().readFeatures(json)
                        if (json.features[0]){
                            this.topooh = json.features[0].properties.topooh
                            let clayer = map.getLayers().item(2)
                            clayer.getSource().clear()
                            layer.getSource().addFeatures(features)
                        }
                    });
            }
            console.log(url)
        });
    },
}).mount('#results');