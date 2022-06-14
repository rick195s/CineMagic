let scanner = new Instascan.Scanner({
    video: document.getElementById('preview'),
    scanPeriod: 1,
    mirror: false,
    refractoryPeriod: 1000,
});

//  ----------------------- LIGAR A CAMERA QUANDO É ABERTO O MODAL SCANNER -----------------------
$("#qrScannerModal").on('shown.bs.modal', function () {

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
//  ----------------------- END LIGAR A CAMERA QUANDO É ABERTO O MODAL SCANNER -----------------------

//  ----------------------- FAZER PEDIDO AJAX DEPOIS DE SER LIDO O QRCODE -----------------------
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
            $("#qrScannerModal").modal('hide');
            $messageModalContent = $('#qrScannerModal2Content');
            $messageModalContent.removeClass('bg-danger');
            $messageModalContent.addClass('bg-success');
            $messageModalContent.find("h3").text(response.message)
            $('#qrScannerModal2').modal('show');
        },
        error: (response) => {
            $response = jQuery.parseJSON(response.responseText );

            $("#qrScannerModal").modal('hide');
            $messageModalContent = $('#qrScannerModal2Content');
            $messageModalContent.removeClass('bg-success');
            $messageModalContent.addClass('bg-danger');
            $messageModalContent.find("h3").text($response.message)
            $('#qrScannerModal2').modal('show');
        }
    });
}
//  ----------------------- END FAZER PEDIDO AJAX DEPOIS DE SER LIDO O QRCODE -----------------------

//  ----------------------- DESLIGAR CAMERA QUANDO O UTILIZADOR CLICA FORA DO MODAL -----------------------

$('#qrScannerModal').on('hidden.bs.modal', function () {
    scanner.stop();
})

//  ----------------------- END DESLIGAR CAMERA QUANDO O UTILIZADOR CLICA FORA DO MODAL -----------------------
