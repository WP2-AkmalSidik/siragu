const ajaxCall = (
    url,
    method = 'GET',
    data = {},
    successCallback = () => {},
    errorCallback = () => {}
) => {
    const isFormData = data instanceof FormData

    $.ajax({
        type: method,
        url,
        cache: false,
        data: data,
        contentType: isFormData
            ? false
            : 'application/x-www-form-urlencoded; charset=UTF-8',
        processData: !isFormData,
        headers: {
            Accept: 'application/json',
            'X-CSRF-TOKEN': $("meta[name='csrf-token']").attr('content')
        },
        dataType: 'json',
        success: successCallback,
        error: errorCallback
    })
}

function formatTanggal (timestamp) {
    const tanggal = new Date(timestamp)
    const options = { day: 'numeric', month: 'long', year: 'numeric' }
    return tanggal.toLocaleDateString('id-ID', options)
}

function showToast (icon = 'success', message) {
    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        theme: 'dark',
        timer: 3000,
        timerProgressBar: true,
        didOpen: toast => {
            toast.onmouseenter = Swal.stopTimer
            toast.onmouseleave = Swal.resumeTimer
        }
    })
    Toast.fire({
        icon: icon,
        title: message
    })
}

function successToast (response, redirect = null) {
    console.log(response)
    showToast('success', response.message)

    setTimeout(() => {
        if (redirect) {
            window.location.href = redirect
        }
    }, 3000)
}

function errorToast (error) {
    console.log(error)
    const message = error?.message || error.responseJSON.message || error || '-'
    showToast('error', message)
}

function showSwal (title, icon, message, redirect = null) {
    swal.fire({
        title: title,
        icon: icon,
        text: message,
        theme: getSavedTheme(),
        timer: 2000,
        buttons: false
    }).then(function () {
        if (redirect) {
            window.location.href = redirect
        }
    })
}

const handleSuccess = (response, modalId = null, redirect = null) => {
    showSwal('Berhasil', 'success', response.message, redirect)

    if (modalId !== null) {
        $(`#${modalId}`).modal('hide')
    }
}

function getSavedTheme () {
    return localStorage.getItem('theme') || 'light'
}

const handleValidationErrors = (error, formId = null, fields = null) => {
    if (error.responseJSON.data && fields) {
        fields.forEach(field => {
            if (error.responseJSON.data[field]) {
                $(`#${formId} #${field}`).addClass('is-invalid')
                $(`#${formId} #error${field}`).html(
                    error.responseJSON.data[field][0]
                )
            } else {
                $(`#${formId} #${field}`).removeClass('is-invalid')
                $(`#${formId} #error${field}`).html('')
            }
        })
    } else {
        console.log(error.responseJSON.message)
        const errors = error.responseJSON.message || error?.message || '-'
        showSwal('Gagal', 'error', errors)
    }
}

const handleSimpleError = error => {
    console.log(error)
    const errors = error.responseJSON.message || error?.message || '-'
    showSwal('Gagal', 'error', errors)
}

const confirmApprove = (url, modalId) => {
    swal.fire({
        title: 'Apakah Kamu Yakin?',
        text: 'Data akan dihapus, data tidak dapat dikembalikan',
        icon: 'warning',
        buttons: true,
        dangerMode: true
    }).then(willApprove => {
        if (willApprove) {
            const data = null

            const successCallback = function (response) {
                handleSuccess(response, modalId, null)
            }

            const errorCallback = function (error) {
                console.log(error)
            }

            ajaxCall(url, 'GET', data, successCallback, errorCallback)
        }
    })
}

function confirmLogout (url, redirect = null) {
    swal.fire({
        title: 'Apakah Kamu Yakin?',
        text: 'Anda akan logout dari aplikasi.',
        icon: 'warning',
        buttons: true,
        dangerMode: true
    }).then(willApprove => {
        if (willApprove) {
            const data = null

            const successCallback = function (response) {
                successToast(response, redirect)
            }

            const errorCallback = function (error) {
                errorToast(error)
            }

            console.log(url)

            ajaxCall(url, 'POST', data, successCallback, errorCallback)
        }
    })
}

const loadSelectOptions = (selector, url, selectedValue = null) => {
    const selectElem = $(selector)

    // Kosongkan dulu opsi yang ada
    selectElem.empty()

    // Tambah opsi kosong dulu
    const emptyOption = $('<option></option>')
        .attr('value', '')
        .text('-- Pilih Data --')
    selectElem.append(emptyOption)

    const successCallback = function (response) {
        console.log(response)
        const responseList = response.data
        responseList.forEach(row => {
            const option = $('<option></option>')
                .attr('value', row.id)
                .text(
                    row.cost
                        ? `${row.cost} - ${row.service} - ${row.etd}`
                        : row.label ?? row.nama ?? row.judul ?? row.name
                )
            selectElem.append(option)
        })

        // Set pilihan default kalau ada
        if (selectedValue !== null) {
            selectElem.val(selectedValue)
        }
    }

    const errorCallback = function (error) {
        console.error(error)
    }

    const data = {
        mode: 'select'
    }

    ajaxCall(url, 'GET', data, successCallback, errorCallback)
}
