const form = document.querySelector('[data-booking]');

if (form) {
    const seats = Array.from(form.querySelectorAll('input[name="seats[]"]:not(:disabled)'));
    const limit = Number(form.dataset.limit);
    const price = Number(form.dataset.price);
    const closed = form.dataset.closed === '1';
    const submit = form.querySelector('button[type="submit"]');
    const countDisplay = form.querySelector('[data-seat-count]');
    const listDisplay = form.querySelector('[data-seat-list]');
    const totalDisplay = form.querySelector('[data-seat-total]');
    const limitDisplay = form.querySelector('[data-seat-limit]');
    const rupiah = new Intl.NumberFormat('id-ID', { maximumFractionDigits: 0 });

    function updateSelection() {
        const selected = seats.filter((seat) => seat.checked).map((seat) => seat.value);
        countDisplay.textContent = selected.length;
        listDisplay.textContent = selected.join(', ') || '—';
        totalDisplay.textContent = 'Rp' + rupiah.format(selected.length * price);
        submit.disabled = closed || selected.length === 0 || selected.length > limit;
    }

    for (const seat of seats) {
        seat.addEventListener('change', () => {
            const selected = seats.filter((choice) => choice.checked).length;

            if (seat.checked && selected > limit) {
                seat.checked = false;
                limitDisplay.textContent = 'Maksimal ' + limit + ' kursi. Hapus satu pilihan untuk mengganti kursi.';
            } else {
                limitDisplay.textContent = '';
            }

            updateSelection();
        });
    }

    updateSelection();
}
