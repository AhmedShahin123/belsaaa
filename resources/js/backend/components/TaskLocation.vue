<template>

    <div style="height: 500px; width: 100%">
        <l-map
            v-if="showMap"
            :zoom="zoom"
            :center="pointLatLng"
            :options="mapOptions"
            style="height: 80%"
            @click="onClickOnMap"
        >
            <l-tile-layer
                :url="url"
                :attribution="attribution"
            />
            <l-marker :lat-lng="pointLatLng" :icon="icon">
                <l-tooltip :options="{ permanent: true, interactive: true }">
                    <div>
                        Employer's location
                    </div>
                </l-tooltip>
            </l-marker>
        </l-map>
    </div>
</template>

<script>
    import { latLng } from "leaflet";
    import { LMap, LTileLayer, LMarker, LPopup, LTooltip } from "vue2-leaflet";
    import { Icon } from 'leaflet';

    export default {
        components: {
            LMap,
            LTileLayer,
            LMarker,
            LPopup,
            LTooltip
        },
        props: {
            point: Object,
            enableSelection: {
                type: Boolean,
                default: false
            },
            latitudeFieldId: null,
            longitudeFieldId: null,
        },
        methods: {
            onClickOnMap: function(event) {
                if (this.enableSelection) {
                    this.selectedLocation = {latitude: event.latlng.lat, longitude: event.latlng.lng}
                }
            }
        },
        data() {
            return {
                zoom: 13,
                url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                attribution:
                    '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
                currentZoom: 11.5,
                showParagraph: false,
                mapOptions: {
                    zoomSnap: 0.5
                },
                showMap: true,
                selectedLocation: null,
            };
        },
        computed: {
            pointLatLng: function() {
                if (this.selectedLocation !== null) {
                    if (this.latitudeFieldId) {
                        $('#'+this.latitudeFieldId).val(this.selectedLocation.latitude);
                    }
                    if (this.longitudeFieldId) {
                        $('#'+this.longitudeFieldId).val(this.selectedLocation.longitude);
                    }
                    return latLng(this.selectedLocation.latitude, this.selectedLocation.longitude);
                }

                if (this.point.latitude !== null && this.point.longitude !== null) {
                    if (this.latitudeFieldId) {
                        $('#'+this.latitudeFieldId).val(this.point.latitude);
                    }
                    if (this.longitudeFieldId) {
                        $('#'+this.longitudeFieldId).val(this.point.longitude);
                    }
                    return latLng(this.point.latitude, this.point.longitude);
                }

                return null;
            },
            icon: function() {
                let icon = new L.Icon.Default();
                icon.options.shadowSize = [0,0];

                return icon;
            }
        },
    };
</script>
