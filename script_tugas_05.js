$(document).ready(function () {
    // Fade-in efek untuk gambar di galeri
    $('.gallery img').each(function (index) {
        $(this).delay(200 * index).fadeTo(1000, 1); // Fade-in secara bertahap
    });

    // Event klik pada gambar untuk membuka modal
    $('.gallery img').click(function () {
        const src = $(this).attr('src');
        $('#modalImage').attr('src', src);
        $('#modal').fadeIn();
    });

    // Menutup modal saat tombol "Close" diklik
    $('.close').click(function () {
        $('#modal').fadeOut();
    });

    // Menutup modal saat area di luar gambar diklik
    $('#modal').click(function (e) {
        if (e.target === this) {
            $(this).fadeOut();
        }
    });
});
