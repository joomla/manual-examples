import {LeafletMap, TileLayer, Marker} from "https://cdn.jsdelivr.net/npm/leaflet@2.0.0-alpha.1/dist/leaflet.js";

const params = Joomla.getOptions('com_example.mapParams');
if (params.locationDefined) {
    const latitude = parseFloat(params.latitude);
    const longitude = parseFloat(params.longitude);
    const zoom = parseInt(params.zoom);

    const map = new LeafletMap('map').setView([latitude, longitude], zoom);

    new TileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    new Marker([latitude, longitude]).addTo(map)
        .bindPopup(params.landmark)
        .openPopup();
} else {
    document.getElementById("map").innerText = Joomla.Text._("COM_EXAMPLE_LANDMARK_LOCATION_NOT_DEFINED");
}