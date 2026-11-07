const printTicketButton = document.querySelector('[data-print-ticket]');

printTicketButton.hidden = false;
printTicketButton.addEventListener('click', () => window.print());
