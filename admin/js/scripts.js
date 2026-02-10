'use strict';

(() => {
    document.addEventListener('DOMContentLoaded', () => {
        function changeDelivery() {
            const inputs = document.querySelectorAll('.delivery-value');
            
            inputs.forEach(item => {
                item.addEventListener('input', () => {
                    item.defaultValue = item.value;
                });
            })
        }
        
        changeDelivery();
    })
})()
