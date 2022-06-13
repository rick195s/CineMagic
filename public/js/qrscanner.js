
$("#qrScannerModal").on('shown.bs.modal', function() {
    let scanner = new Instascan.Scanner({
        video: document.getElementById('preview'),
        scanPeriod: 1,
        mirror: false,
        refractoryPeriod: 1000,
    });

    Instascan.Camera.getCameras().then(function(cameras) {
        if (cameras.length > 0) {
            scanner.start(cameras[0]);
        } else {
            console.error('No cameras found.');
        }
    }).catch(function(e) {
        console.error(e);
    });
});
