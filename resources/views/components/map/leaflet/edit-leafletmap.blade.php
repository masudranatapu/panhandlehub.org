@props([
    'lat' => setting('default_lat'),
    'long' => setting('default_long'),
    'marker' => true,
])

<x-map.leaflet.map_scripts />
<x-map.leaflet.autocomplete_scripts />
<script>
    var oldlat = {{ $lat }};
    var oldlng = {{ $long }};

    // Map preview
    var element = document.getElementById('leaflet-map');

    // Height has to be set. You can do this in CSS too.
    element.style = 'height:300px;';

    // Create Leaflet map on map element.
    var leaflet_map = L.map(element);

    // Add OSM tile layer to the Leaflet map.
    L.tileLayer('http://{s}.tile.osm.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(leaflet_map);

    // Target's GPS coordinates.
    var target = L.latLng(oldlat, oldlng);

    // Set map's center to target with zoom 14.
    const zoom = 7;
    leaflet_map.setView(target, zoom);

    // Place a marker on the same location.
    var markers = new L.FeatureGroup();
    var marker = L.marker(target, {
        draggable: "{{ $marker }}"
    });

    marker.addTo(markers);
    markers.addTo(leaflet_map);

    // if marker enable 
    if("{{ $marker }}"){
        // marker drugEnd
        marker.on("dragend", function(e) {
            var marker = e.target;
            var position = marker.getLatLng();
            leaflet_map.panTo(new L.LatLng(position.lat, position.lng));
            // call api to get address from lat & lng
            $.get(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${position.lat}&lon=${ position.lng}`,
                function(
                    data) {
                    var country = data.address.country;
                    var region = data.address.state;
                    var district = data.address.state_district;
                    var place = data.address.city;
    
                    // save location data in session
                    var form = new FormData();
                    form.append('lat', position.lat);
                    form.append('lng', position.lng);
    
                    form.append('country', country);
                    form.append('region', region);
                    form.append('district', district);
                    form.append('place', place);
    
                    axios.post(
                            '/set/session', form
                        )
                        .then((res) => {
                            // console.log(res.data);
                            // toastr.success("Location Saved", 'Success!');
                        })
                        .catch((e) => {
                            toastr.error("Something Wrong", 'Error!');
                        });
                });
            // call api to get address from lat & lng END
    
        });
        // marker drugEnd END
    
        // map click set marker
        leaflet_map.on('click', function(e) {
    
            let lat = e.latlng.lat;
            let lng = e.latlng.lng;
            leaflet_map.panTo(new L.LatLng(lat, lng));
    
            markers.clearLayers(); //c clear old merkers
    
            // re init marker
            var marker = L.marker([lat, lng], {
                draggable: true
            });
            setTimeout(() => {
                marker.addTo(markers);
                markers.addTo(leaflet_map);
            }, 100);
            //  re init marker END
    
            // call api to get address from lat & lng
            $.get(`https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`, function(
                data) {
                var country = data.address.country;
                var region = data.address.state;
                var district = data.address.state_district;
                var place = data.address.city;
                // save location data in session
                var form = new FormData();
                form.append('lat', lat);
                form.append('lng', lng);
    
                form.append('country', country);
                form.append('region', region);
                form.append('district', district);
                form.append('place', place);
    
                axios.post(
                        '/set/session', form
                    )
                    .then((res) => {
                        // console.log(res.data);
                        // toastr.success("Location Saved", 'Success!');
                    })
                    .catch((e) => {
                        toastr.error("Something Wrong", 'Error!');
                    });
            });
            // call api to get address from lat & lng END
    
        });
        // map click set marker  END
    }
</script>
