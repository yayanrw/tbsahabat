</div>
</div>
</div>
</div>

<!-- Javascripts -->
<script src="<?= base_url('assets/plugins/jquery/jquery-3.5.1.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/bootstrap/js/bootstrap.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/perfectscroll/perfect-scrollbar.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/pace/pace.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/apexcharts/apexcharts.min.js') ?>"></script>
<script src="<?= base_url('assets/plugins/datatables/datatables.min.js') ?>"></script>
<script src="<?= base_url('assets/js/main.min.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/js/all.min.js" integrity="sha512-8pHNiqTlsrRjVD4A/3va++W1sMbUHwWxxRPWNyVlql3T+Hgfd81Qc6FC5WMXDC+tSauxxzp1tgiAvSKFu1qIlA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.5/jquery.validate.min.js" integrity="sha512-rstIgDs0xPgmG6RX1Aba4KV5cWJbAMcvRCVmglpam9SoHZiUCyQVDdH2LPlxoHtrv17XWblE/V/PP+Tr04hbtA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="<?= base_url('assets/plugins/select2/js/select2.full.min.js') ?>"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="<?= base_url('assets/js/kendo.all.min.js') ?>"></script>
<script src="<?= base_url('assets/js/custom.js') ?>"></script>
<script>
	$(document).ready(() => {
		// Promise.all([
		// 	callNotifikasi()
		// ]).catch(e => swalError(`${ERROR_WARN}, ${JSON.stringify(error)}`))

	})

	$("select").select2({
		width: '100%'
	});

	const callNotifikasi = async () => {
		try {
			const BASE_URL = "<?= base_url() ?>";
			const res = await createPromise(
				`${BASE_URL}/transaction/notifikasi`,
				'GET', {}
			)

			if (!res.status) {
				swalWarning(ALERT, res.message)
			} else {
				$.each(res.data, function(index, item) {
					// Create a new element using the HTML code
					var newElement = $('<a href="' + `${BASE_URL}transaction/detail/${item.id}` + '">' +
						'<div class="notifications-dropdown-item">' +
						'<div class="notifications-dropdown-item-image">' +
						'<span class="notifications-badge bg-info text-white">' +
						'<i class="material-icons-outlined">campaign</i>' +
						'</span>' +
						'</div>' +
						'<div class="notifications-dropdown-item-text">' +
						'<p class="bold-notifications-text">Customer a.n <b>' + item.customer_name + '</b> melakukan transaksi sebesar <b>' + item.grand_total + '</b> di Seller a.n <b>' + item.seller_name + '</b></p>' +
						'<small>' + item.insert_dt + '</small>' +
						'</div>' +
						'</div>' +
						'</a>');

					// Append the new element to the #list-notifikasi element
					$('#list-notifikasi').append(newElement);
				});
			}
		} catch (error) {
			swalError(`${ERROR_WARN}, ${JSON.stringify(error)}`)
			return error
		}
	}
</script>
<?= !empty($js) ? $this->load->view($js) : '' ?>

</body>

</html>
