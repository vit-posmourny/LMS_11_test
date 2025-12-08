document.addEventListener("DOMContentLoaded", function () {
    // Najdeme všechny elementy s třídou .is-tom-select
    var selectElements = document.querySelectorAll('.is-tom-select');

    // Projdeme každý nalezený element a inicializujeme TomSelect
    selectElements.forEach(function (el) {
        // (Volitelné) Kontrola, zda už na elementu neběží instance, aby nedošlo k duplicitě
        if (el.tomselect) {
            return;
        }

        new TomSelect(el, {
            copyClassesToDropdown: false,
            dropdownClass: 'dropdown-menu ts-dropdown',
            optionClass: 'dropdown-item',
            controlInput: '<input>',
            render: {
                item: function(data, escape) {
                    if (data.customProperties) {
                        return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
                    }
                    return '<div>' + escape(data.text) + '</div>';
                },
                option: function(data, escape) {
                    if (data.customProperties) {
                        return '<div><span class="dropdown-item-indicator">' + data.customProperties + '</span>' + escape(data.text) + '</div>';
                    }
                    return '<div>' + escape(data.text) + '</div>';
                },
            },
        });
    });
});
