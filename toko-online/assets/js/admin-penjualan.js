document.addEventListener('DOMContentLoaded', function() {
    const filterDate = document.getElementById('filterDate');
    const dataTable = document.getElementById('dataTable');
    if (filterDate && dataTable) {
        const tableBody = dataTable.querySelector('tbody');
        const rows = tableBody ? tableBody.querySelectorAll('tr') : [];

        filterDate.addEventListener('change', function() {
            const selectedDate = this.value; // Format: YYYY-MM-DD
            
            rows.forEach(row => {
                // Skip if it's the custom 'no-data-found' row
                if (row.classList.contains('no-data-found')) return;

                // Get date from the 8th column (index 7)
                // Format in table: d/m/Y H:i
                if (row.cells.length > 7) {
                    const dateText = row.cells[7].innerText.trim();
                    if (!dateText || dateText === '-') return;

                    const datePart = dateText.split(' ')[0]; // Get d/m/Y
                    const parts = datePart.split('/');
                    if (parts.length === 3) {
                        // Convert d/m/Y to YYYY-MM-DD for comparison
                        const rowDate = `${parts[2]}-${parts[1].padStart(2, '0')}-${parts[0].padStart(2, '0')}`;
                        
                        if (selectedDate === "" || rowDate === selectedDate) {
                            row.style.display = "";
                        } else {
                            row.style.display = "none";
                        }
                    }
                }
            });
            
            // Check if no rows are visible
            const visibleRows = Array.from(rows).filter(r => r.style.display !== "none" && !r.classList.contains('no-data-found'));
            const existingNoData = tableBody.querySelector('.no-data-found');
            
            if (visibleRows.length === 0) {
                if (!existingNoData) {
                    const noDataRow = document.createElement('tr');
                    noDataRow.className = 'no-data-found';
                    noDataRow.innerHTML = `<td colspan="9" class="text-center py-5 text-muted">
                        <i class="fas fa-calendar-times fa-3x mb-3 d-block opacity-2"></i>
                        Tidak ada transaksi pada tanggal ${selectedDate.split('-').reverse().join('/')}
                    </td>`;
                    tableBody.appendChild(noDataRow);
                }
            } else {
                if (existingNoData) existingNoData.remove();
            }
        });
    }
});

// Function to show transaction details inside Bootstrap modal
window.showDetailModal = function(id) {
    const modal = $('#detailModal');
    const modalTitle = $('#detailModalLabel');
    const modalBody = $('#detailModalBody');
    
    modalTitle.text(`#INV-${String(id).padStart(5, '0')} - Detail Transaksi`);
    modalBody.html(`
        <div class="text-center py-5">
            <div class="spinner-border text-accent" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
    `);
    
    modal.modal('show');
    
    fetch(`${DETAIL_BASE_URL}${id}`)
        .then(response => {
            if (!response.ok) throw new Error('Network response was not ok');
            return response.json();
        })
        .then(data => {
            const order = data.order;
            const items = data.items;
            
            const orderDate = new Date(order.order_date);
            const formattedDate = orderDate.toLocaleDateString('id-ID', {
                day: '2-digit',
                month: 'long',
                year: 'numeric',
                hour: '2-digit',
                minute: '2-digit'
            });
            
            const formattedTotal = new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR',
                maximumFractionDigits: 0
            }).format(order.total_amount);
            
            let itemsHtml = '';
            items.forEach((item, index) => {
                const price = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    maximumFractionDigits: 0
                }).format(item.price);
                
                const subtotal = new Intl.NumberFormat('id-ID', {
                    style: 'currency',
                    currency: 'IDR',
                    maximumFractionDigits: 0
                }).format(item.price * item.quantity);
                
                itemsHtml += `
                    <tr>
                        <td class="center text-muted" style="border-top: 1px solid rgba(255,255,255,0.05);">${index + 1}</td>
                        <td class="left font-weight-bold text-white" style="border-top: 1px solid rgba(255,255,255,0.05);">${item.name}</td>
                        <td class="right text-white text-right" style="border-top: 1px solid rgba(255,255,255,0.05);">${price}</td>
                        <td class="center text-white text-center" style="border-top: 1px solid rgba(255,255,255,0.05);">${item.quantity}</td>
                        <td class="right text-accent font-weight-bold text-right" style="border-top: 1px solid rgba(255,255,255,0.05);">${subtotal}</td>
                    </tr>
                `;
            });
            
            document.getElementById('btnPrintInvoice').onclick = function() {
                window.open(`${PRINT_BASE_URL}${id}`, '_blank');
            };
            
            let badgeClass = 'badge-secondary';
            if(order.status === 'pending') badgeClass = 'badge-warning';
            else if(order.status === 'processed') badgeClass = 'badge-info';
            else if(order.status === 'shipping') badgeClass = 'badge-primary';
            else if(order.status === 'completed') badgeClass = 'badge-success';
            else if(order.status === 'cancelled') badgeClass = 'badge-danger';

            modalBody.html(`
                <div class="row mb-4">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <h6 class="text-accent font-weight-bold uppercase mb-2" style="letter-spacing: 1px; font-size: 0.75rem;">Dari:</h6>
                        <div class="text-white" style="font-size: 0.85rem; line-height: 1.6;">
                            <h5 class="font-weight-bold text-white mb-1">VERIDIAN Luxury Tech Development</h5>
                            <div>Menara Kencana Lantai 42, Jakarta Selatan</div>
                            <div>Jakarta, Indonesia</div>
                            <div>Email: info@veridian.com</div>
                            <div>Phone: +62 867-3558-8615</div>
                        </div>
                    </div>

                    <div class="col-sm-6 text-sm-right">
                        <h6 class="text-accent font-weight-bold uppercase mb-2" style="letter-spacing: 1px; font-size: 0.75rem;">Kepada:</h6>
                        <div class="text-white" style="font-size: 0.85rem; line-height: 1.6;">
                            <h5 class="font-weight-bold text-white mb-1">${order.fullname}</h5>
                            <div>${order.address || '-'}</div>
                            <div>Email: ${order.email}</div>
                            <div>Phone: ${order.phone_number || '-'}</div>
                        </div>
                    </div>
                </div>

                <div class="row mb-4 pt-3 border-top border-sec-dark">
                    <div class="col-sm-6 mb-3 mb-sm-0">
                        <h6 class="text-accent font-weight-bold uppercase mb-2" style="letter-spacing: 1px; font-size: 0.75rem;">Detail Pesanan:</h6>
                        <div class="text-white" style="font-size: 0.85rem; line-height: 1.6;">
                            <div>Invoice: <span class="font-weight-bold text-accent">#INV-${String(order.id).padStart(5, '0')}</span></div>
                            <div>Tanggal: ${formattedDate}</div>
                            <div>Status: <span class="badge ${badgeClass}" style="font-size: 0.65rem; padding: 4px 8px;">${order.status.toUpperCase()}</span></div>
                        </div>
                    </div>
                    <div class="col-sm-6 text-sm-right">
                        <h6 class="text-accent font-weight-bold uppercase mb-2" style="letter-spacing: 1px; font-size: 0.75rem;">Metode Pembayaran:</h6>
                        <div class="text-white" style="font-size: 0.85rem; line-height: 1.6;">
                            <div class="font-weight-bold text-white mb-1">${order.payment_method.toUpperCase()}</div>
                            <div class="text-muted small">${order.payment_detail || ''}</div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive mt-4">
                    <table class="table table-dark-custom mb-0" style="font-size: 0.8rem;">
                        <thead>
                            <tr>
                                <th style="background: #24262d !important; color: var(--accent-green) !important; border: none !important;">#</th>
                                <th style="background: #24262d !important; color: var(--accent-green) !important; border: none !important;">Item</th>
                                <th class="text-right" style="background: #24262d !important; color: var(--accent-green) !important; border: none !important;">Harga Unit</th>
                                <th class="text-center" style="background: #24262d !important; color: var(--accent-green) !important; border: none !important;">Qty</th>
                                <th class="text-right" style="background: #24262d !important; color: var(--accent-green) !important; border: none !important;">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            ${itemsHtml}
                        </tbody>
                    </table>
                </div>

                <div class="row mt-4">
                    <div class="col-lg-6 ml-auto">
                        <table class="table table-clear text-white" style="font-size: 0.8rem; margin-bottom: 0;">
                            <tbody>
                                <tr>
                                    <td class="left border-0 pl-0">Subtotal</td>
                                    <td class="right border-0 pr-0 text-right font-weight-bold">${formattedTotal}</td>
                                </tr>
                                <tr>
                                    <td class="left border-0 pl-0">PPN (0%)</td>
                                    <td class="right border-0 pr-0 text-right font-weight-bold">Rp 0</td>
                                </tr>
                                <tr style="border-top: 1px solid var(--accent-green) !important; background: rgba(74, 222, 128, 0.05);">
                                    <td class="left pl-2 font-weight-bold text-accent">Total Pembayaran</td>
                                    <td class="right pr-2 text-right font-weight-bold text-accent">${formattedTotal}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            `);
        })
        .catch(err => {
            console.error(err);
            modalBody.html(`
                <div class="text-center py-5 text-danger">
                    <i class="fas fa-exclamation-triangle fa-2x mb-3"></i>
                    <p>Gagal memuat data transaksi. Periksa jaringan Anda atau coba lagi.</p>
                </div>
            `);
        });
};
