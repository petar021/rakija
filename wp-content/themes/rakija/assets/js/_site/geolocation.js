'use strict';
const Geolocation = {
    init: function() {
        document.getElementById('show-route').addEventListener('click', function (e) {
            e.preventDefault();

            // Lokacije ka kojima želiš da korisnik ide (lat, lng)
            const destinations = [
                { lat: 45.249699, lng: 19.833318 }, // Rakija House - Futoska
                { lat: 45.257059, lng: 19.841932 }, // Rakija House - Njegoseva
            ];

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    const userLat = position.coords.latitude;
                    const userLng = position.coords.longitude;

                    // Izračunaj rastojanje do svih destinacija
                    let nearest = destinations[0];
                    let minDistance = getDistance(userLat, userLng, destinations[0].lat, destinations[0].lng);

                    destinations.forEach(dest => {
                        const dist = getDistance(userLat, userLng, dest.lat, dest.lng);
                        if (dist < minDistance) {
                            minDistance = dist;
                            nearest = dest;
                        }
                    });

                    // Otvori Google Maps u Directions modu
                    const mapsUrl = `https://www.google.com/maps/dir/?api=1&origin=${userLat},${userLng}&destination=${nearest.lat},${nearest.lng}&travelmode=driving`;
                    window.open(mapsUrl, '_blank');
                });
            } else {
                alert('Geolokacija nije podržana u vašem pretraživaču.');
            }

            // Funkcija za izračunavanje rastojanja (Haversine formula)
            function getDistance(lat1, lon1, lat2, lon2) {
                const R = 6371; // km
                const dLat = (lat2 - lat1) * Math.PI / 180;
                const dLon = (lon2 - lon1) * Math.PI / 180;
                const a = Math.sin(dLat / 2) * Math.sin(dLat / 2) +
                        Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                        Math.sin(dLon / 2) * Math.sin(dLon / 2);
                const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1 - a));
                return R * c;
            }
        });
    }
};
export default Geolocation;