$(document).ready(function () {
	setTodayDate();
	setInterval(updateTime, 1000);
});

// Here goes your custom javascript
const SOCKET_BASE_URL = "http://10.100.100.80:3000"; //Ganti dengan ip server yang terpasang service socket
const ARE_YOU_SURE = "Apakah anda yakin?";
const INSERT_DATA_WARN = "Apakah anda ingin menyimpan data ini?";
const UPDATE_DATA_WARN = "Apakah anda ingin mengubah data ini";
const DELETE_DATA_WARN = "Apakah anda ingin menghapus data ini";
const RECONNECT_DATA_WARN = "Apakah anda ingin menyambungkan kembali data ini";
const OVER_LIMIT_WARN =
	"Jumlah pending + Jumlah valid melebihi total maximum Koli. Jumlah data yang melebihi akan di-reject otomatis. Lanjutkan?";
const LOAD_EXISTING_SERIALIZATION_WARN =
	"Terdapat serialisasi yang belum terselesaikan. Lanjutkan serialisasi?";
const REJECT_DATA_WARN = "Apakah anda ingin me-reject data ini?";
const INSERT_IT = "Simpan";
const UPDATE_IT = "Ubah";
const DELETE_IT = "Hapus";
const RECONNECT_IT = "Sambungkan kembali";
const CONTINUE = "Lanjutkan";
const ERROR_WARN =
	"Terjadi kesalahan saat memproses permintaan Anda, harap coba lagi.";
const TRY_AGAIN = "Silakan coba lagi nanti";
const NO_DATA = "Data tidak ditemukan";
const SESSION_NOT_FOUND = "ID Session tidak ditemukan";
const VALID_DATA_NOT_REACHED =
	"Jumlah data valid belum memenuhi jumlah limit per koli";
const ALREADY_IN_LIST = "Kode QR sudah ada dalam daftar";
const ADDED_TO_LIST = "Kode QR berhasil ditambahkan ke daftar";
const WAIT_TO_MANIFEST = "Menunggu di manifest-kan";
const WAIT_TO_FINISHING = "Menunggu di proceed";
const QR_CODE_NOT_VALID = "Qrcode tidak dikenali";
const ALREADY_IN_DB = "Kode QR sudah ada di database";
const EXCEED_TARGET = "Jumlah sudah melebihi limit";
const NOT_BELONG_PRODUCT = "Produk tidak sesuai";
const QRCODE_NOT_FOUND = "Qrcode tidak ditemukan";
const PENDING = "Tertunda";
const NO_CONNECTION = "Tidak dapat menjangkau server";
const PROCESS = "Dalam proses";
const NO_PENDING = "Tidak ada Qrcode yang tertunda";
const SUCCESS = "Sukses";
const STOP = "Stop!";
const ALERT = "Peringatan";
const WEIGHT_NOT_BE_NULL = "Form Berat tidak boleh kosong";
const OVER_LIMIT = "Melebihi kuota dalam koli";
const PRODUCT_REQUIRED = "Pastikan anda sudah memilih Produk";
const FORM_REQUIRED = "Pastikan semua form sudah terisi";
const REGEX_QR_CODE = /^msgl\.io\/[a-z0-9]{8}$/i;
const EXCEED_MAX_BATCH = "Tidak boleh ada lebih dari 2 Batch Number";
const BATCH_NOT_REGISTERED = "Batch Number tidak terdaftar";
const NOT_EXCEED_TARGET = "Jumlah barang tidak memenuhi target";
const MAX_WAREHOUSE = "Maksimal hanya ada 1 warehouse yang terdaftar";
const MAKE_SURE_DATE_FORMAT = "Pastikan format tanggal sesuai";

toastr.options = {
	closeButton: false,
	debug: false,
	newestOnTop: false,
	progressBar: false,
	positionClass: "toast-top-center",
	preventDuplicates: false,
	onclick: null,
	showDuration: "300",
	hideDuration: "1000",
	timeOut: "5000",
	extendedTimeOut: "1000",
	showEasing: "swing",
	hideEasing: "linear",
	showMethod: "fadeIn",
	hideMethod: "fadeOut",
	progressBar: true,
};

swalSuccess = (title) => {
	if (title == "delete") {
		Swal.fire(
			"Sukses Menghapus!",
			"Data anda telah berhasil dihapus.",
			"success"
		);
	} else if (title == "update") {
		Swal.fire(
			"Sukses Mengubah!",
			"Data anda telah berhasil diubah.",
			"success"
		);
	} else if (title == "active") {
		Swal.fire(
			"Sukses Diaktifkan!",
			"Data anda telah berhasil diubah.",
			"success"
		);
	} else if (title == "inactive") {
		Swal.fire(
			"Sukses Dinonaktifkan!",
			"Data anda telah berhasil diubah.",
			"success"
		);
	} else if (title == "close") {
		Swal.fire("Sukses Ditutup!", "Data anda telah berhasil diubah.", "success");
	} else if (title == "reject") {
		Swal.fire(
			"Sukses Direject!",
			"Data anda telah berhasil direject.",
			"success"
		);
	} else if (title == "reload_serialization") {
		Swal.fire(
			"Sukses Dimuat Ulang",
			"Serialisasi berhasil dimuat ulang.",
			"success"
		);
	} else {
		Swal.fire(
			"Sukses Menyimpan!",
			"Data anda telah berhasil disimpan.",
			"success"
		);
	}
};

swalSuccessRedirect = (title) => {
	if (title == "delete") {
		Swal.fire({
			icon: "success",
			title: "Sukses Menghapus!",
			text: "Data anda telah berhasil dihapus.",
			confirmButtonText: "Ok",
		}).then((result) => {
			if (result.isConfirmed) {
				window.history.back();
			}
		});
	} else if (title == "update") {
		Swal.fire({
			icon: "success",
			title: "Sukses Mengubah!",
			text: "Data anda telah berhasil diubah.",
			confirmButtonText: "Ok",
		}).then((result) => {
			if (result.isConfirmed) {
				window.history.back();
			}
		});
	} else {
		Swal.fire({
			icon: "success",
			title: "Sukses Menyimpan!",
			text: "Data anda telah berhasil disimpan.",
			confirmButtonText: "Ok",
		}).then((result) => {
			if (result.isConfirmed) {
				window.history.back();
			}
		});
	}
};

swalError = (text) => {
	Swal.close();
	Swal.fire("Error!", text, "error");
};

swalWarning = (title, text) => {
	Swal.close();
	Swal.fire(title, text, "warning");
};

const confirmationDialog = (type, callBack) => {
	let warn_text;
	let suggestion_text;
	switch (type) {
		case "insert":
			warn_text = INSERT_DATA_WARN;
			suggestion_text = INSERT_IT;
			break;
		case "update":
			warn_text = UPDATE_DATA_WARN;
			suggestion_text = UPDATE_IT;
			break;
		case "delete":
			warn_text = DELETE_DATA_WARN;
			suggestion_text = DELETE_IT;
			break;
		case "reconnect":
			warn_text = RECONNECT_DATA_WARN;
			suggestion_text = RECONNECT_IT;
			break;
		case "over_limit":
			warn_text = OVER_LIMIT_WARN;
			suggestion_text = CONTINUE;
			break;
		case "load_existing_serialization":
			warn_text = LOAD_EXISTING_SERIALIZATION_WARN;
			suggestion_text = CONTINUE;
			break;
		case "reject":
			warn_text = REJECT_DATA_WARN;
			suggestion_text = CONTINUE;
			break;
		default:
			warn_text = ERROR_WARN;
			suggestion_text = TRY_AGAIN;
			break;
	}

	Swal.fire({
		title: ARE_YOU_SURE,
		text: warn_text,
		icon: "warning",
		showCancelButton: true,
		confirmButtonColor: "#3085d6",
		cancelButtonColor: "#d33",
		confirmButtonText: suggestion_text,
	}).then((result) => {
		if (result.value) {
			callBack(true);
		} else {
			callBack(false);
		}
	});
};

const formReset = () => {
	$("#form").validate().resetForm();
	$("#form")[0].reset();
	$("#btnSubmit").html("Submit");
};

const setFormReadonly = (readonly) => {
	if (readonly) {
		$("#form").find("input, textarea").prop("readonly", true);
		$("#form").find("select").prop("disabled", true);
		$("#btnSubmit").prop("disabled", true);
	} else {
		$("#form").find("input, textarea").prop("readonly", false);
		$("#form").find("select").prop("disabled", false);
		$("#btnSubmit").prop("disabled", false);
	}
};

const createPromise = (url, method, data) => {
	return new Promise((resolve, reject) => {
		$.ajax({
			url: url,
			method: method,
			data: data,
			dataType: "json",
			success: function (res) {
				resolve(res);
			},
			error: function (err) {
				reject(err);
			},
		});
	});
};

const scrollToTop = () => {
	$("html, body").animate({ scrollTop: 0 }, "fast");
};

const setTodayDate = () => {
	var today = new Date();
	var indonesianDate = today.toLocaleDateString("id-ID", {
		day: "numeric",
		month: "long",
		year: "numeric",
	});
	$("#detail-description-date").text(`${indonesianDate} • `);
};

const updateTime = () => {
	let currentTime = new Date();
	let hours = currentTime.getHours();
	let minutes = currentTime.getMinutes();
	let seconds = currentTime.getSeconds();

	let timeString =
		(hours < 10 ? "0" + hours : hours) +
		":" +
		(minutes < 10 ? "0" + minutes : minutes) +
		":" +
		(seconds < 10 ? "0" + seconds : seconds);

	$("#detail-description-time").text(`${timeString} `);
};

const nullSafety = (value) => {
	if (value === null || value === undefined) {
		return "N/A";
	} else {
		return value;
	}
};

const convertDate = (value) => {
	const inputDate = value;
	const parts = inputDate.split("-");
	const convertedDate = `${parts[2]}-${parts[1]}-${parts[0]}`;
	return convertedDate;
};
