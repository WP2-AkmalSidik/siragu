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

/**
 * Loads options into a select element from a remote URL
 * @param {string} selector - jQuery selector for the select element
 * @param {string} url - API endpoint URL
 * @param {string|array|null} selectedValue - Value(s) to be selected (supports single or multiple select)
 * @param {string} placeholder - Placeholder text for empty option
 */
const loadSelectOptions = (
    selector,
    url,
    selectedValue = null,
    multiple = false,
    placeholder = '-- Pilih Data --'
) => {
    const selectElem = $(selector)

    if (!selectElem.length) {
        console.error(`Element not found with selector: ${selector}`)
        return
    }

    // Clear existing options and disable select while loading
    selectElem.empty().prop('disabled', true)

    // Add empty option first
    selectElem.append($('<option></option>').val('').text(placeholder))

    const successCallback = function (response) {
        try {
            if (!response || !response.data) {
                throw new Error('Invalid response format')
            }

            const responseList = response.data

            if (!Array.isArray(responseList)) {
                throw new Error('Expected array in response.data')
            }

            responseList.forEach(row => {
                if (!row.id) {
                    console.warn('Missing id in row:', row)
                    return
                }

                const displayText =
                    row.nama || row.jabatan || row.text || row.name || ''
                selectElem.append(
                    $('<option></option>').val(row.id).text(displayText)
                )
            })

            // Set selected value(s) if provided
            if (selectedValue !== null) {
                if (selectElem.attr('multiple')) {
                    // Handle multiple select
                    selectElem.val(
                        Array.isArray(selectedValue)
                            ? selectedValue
                            : [selectedValue]
                    )
                } else {
                    // Handle single select
                    selectElem.val(selectedValue)
                }
            }

            if (multiple == true) {
                console.log('multiple true')
                selectElem.prop('multiple', true)
            }

            selectElem.select2({
                placeholder: 'Pilih Data',
                allowClear: true, // Memungkinkan menghapus semua pilihan
                width: '100%' // Sesuaikan lebar
            })
        } catch (error) {
            console.error('Error processing response:', error)
            // Optionally show error to user
            selectElem.append(
                $('<option></option>').val('').text('Error loading options')
            )
        } finally {
            selectElem.prop('disabled', false)
        }
    }

    const errorCallback = function (error) {
        console.error('API request failed:', error)
        selectElem
            .append(
                $('<option></option>').val('').text('Failed to load options')
            )
            .prop('disabled', false)
    }

    // Make AJAX request
    ajaxCall(url, 'GET', { mode: 'select' }, successCallback, errorCallback)
}
