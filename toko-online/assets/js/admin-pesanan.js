document.addEventListener('DOMContentLoaded', function() {
    const detailButtons = document.querySelectorAll('.view-detail');
    const detailItems = document.getElementById('detail-items');
    
    if (detailItems) {
        detailButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                detailItems.innerHTML = '<tr><td colspan="3" class="text-center">Memuat...</td></tr>';
                
                const detailUrl = typeof PESANAN_DETAIL_URL !== 'undefined' ? PESANAN_DETAIL_URL : '';
                if (detailUrl) {
                    fetch(detailUrl + id)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Network response was not ok');
                            }
                            return response.json();
                        })
                        .then(data => {
                            let html = '';
                            if (data && data.length > 0) {
                                data.forEach(item => {
                                    html += `<tr>
                                        <td>${item.product_name}</td>
                                        <td>${item.quantity}</td>
                                        <td>Rp ${new Intl.NumberFormat('id-ID').format(item.price)}</td>
                                    </tr>`;
                                });
                            } else {
                                html = '<tr><td colspan="3" class="text-center">Tidak ada item dalam pesanan ini.</td></tr>';
                            }
                            detailItems.innerHTML = html;
                        })
                        .catch(err => {
                            console.error('Error fetching order details:', err);
                            detailItems.innerHTML = '<tr><td colspan="3" class="text-center text-danger">Gagal memuat detail pesanan.</td></tr>';
                        });
                }
            });
        });
    }
});
