// resources\js\notyf.js
// Create an instance of Notyf
export const notyf = new Notyf({
    duration: 5000,
    dismissible: true,
    types: [
    {
        type: 'success',
        background: '#2ecc71',
        icon: {
            className: 'fas fa-circle-check',
            tagName: 'i',
            text: '',
            color: 'white'
        }
    },
    {
        type: 'info',
        background: '#3498db',
        icon: {
            className: 'fas fa-circle-info',
            tagName: 'i',
            text: '',
            color: 'white'
        }
    },
    {
        type: 'warning',
        background: '#f39c12',
        icon: {
            className: 'fas fa-circle-exclamation',
            tagName: 'i',
            text: '',
            color: 'white'
        }
    },
    {
        type: 'error',
        background: '#e74c3c',
        icon: {
            className: 'fas fa-circle-xmark',
            tagName: 'i',
            text: '',
            color: 'white'
        }
    }]
});
