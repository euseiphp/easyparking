import 'sweetalert';

window.addEventListener('swal:common', event => {
    swal({
        title: event.detail.message,
        text: event.detail.text,
        icon: event.detail.type,
        closeOnClickOutside: event.detail.closeOnClickOutside ?? true,
    });
});

window.addEventListener('swal:confirm', event => {
    return swal({
        title: event.detail.message,
        text: event.detail.text,
        icon: event.detail.type,
        buttons: ['Cancelar', 'OK'],
        dangerMode: true,
        closeOnClickOutside: event.detail.closeOnClickOutside ?? true,
    }).then((confirm) => {
        if (confirm) {
            return Livewire.emit(event.detail.event, event.detail.append || null)
        }
    });
});
