
$("#qrScannerModal").on('shown.bs.modal', function () {
    let scanner = new Instascan.Scanner({
        video: document.getElementById('preview'),
        scanPeriod: 1,
        mirror: false,
        refractoryPeriod: 1000,
    });
    Instascan.Camera.getCameras().then(function (cameras) {
        if (cameras.length > 0) {
            scanner.start(cameras[0]);

            scanner.addListener('scan', function (url) {
                markTicketAsUsed(url);
            });

        } else {
            console.error('No cameras found.');
        }
    }).catch(function (e) {
        console.error(e);
    });
});


function markTicketAsUsed(url) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        method: "PATCH",
        url: url,
        crossDomain: true,
        dataType: "json",
        data: {
            '_method': 'PATCH',
            'sessao_id': $(".sessao_id")[0].value,
        },
        success: (response) => {
            console.log(response);
        },
        error: (response) => {
            $response = jQuery.parseJSON(response.responseText );
            console.log($response.message);
        }
    });
}
