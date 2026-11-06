// Common Utilities for E-Perpus

$(document).ready(function() {
    // Initialize DataTables
    if ($.fn.DataTable) {
        $('.datatable').DataTable({
            responsive: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.4/i18n/id.json'
            }
        });
    }

    // Common SweetAlert Function
    window.showAlert = function(icon, title, text) {
        Swal.fire({
            icon: icon,
            title: title,
            text: text,
            confirmButtonColor: '#2563EB'
        });
    };

    // Counter Animation
    $('.counter').each(function () {
        $(this).prop('Counter',0).animate({
            Counter: $(this).text()
        }, {
            duration: 2000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });

    // Mobile Sidebar Toggle Handler
    $('#sidebarToggleBtn').on('click', function(e) {
        e.stopPropagation();
        $('.sidebar').toggleClass('show');
        
        // Add backdrop if it doesn't exist
        if ($('.sidebar-backdrop').length === 0) {
            $('body').append('<div class="sidebar-backdrop"></div>');
        }
        $('.sidebar-backdrop').toggleClass('show');
    });

    $(document).on('click', function(e) {
        if ($(window).width() <= 768) {
            if (!$(e.target).closest('.sidebar').length && !$(e.target).closest('#sidebarToggleBtn').length) {
                $('.sidebar').removeClass('show');
                $('.sidebar-backdrop').removeClass('show');
            }
        }
    });

    // Handle backdrop click
    $(document).on('click', '.sidebar-backdrop', function() {
        $('.sidebar').removeClass('show');
        $(this).removeClass('show');
    });
});
