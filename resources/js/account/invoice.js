import * as $ from "jquery";

function loadInvoice() {
    let invoice = document.querySelector('#invoice')
    let invoice_id = invoice.dataset.id

    KTApp.block(invoice, {
        overlayColor: '#000000',
        type: 'v2',
        state: 'primary',
        message: 'Chargement de la facture...'
    })

    $.ajax({
        url: '/account/api/invoice/'+invoice_id,
        success: function (data) {
            console.log(data)
            KTApp.unblock(invoice)
            $("#fieldDate").html(data.data.invoice.date)
            $("#fieldNumberInvoice").html(data.data.invoice.number_invoice)
            $("#fieldInvoiceTo").html(`<span>${data.data.invoice.user.name}</span><br><span><strong>Email:</strong> ${data.data.invoice.user.name}</span>`)

            $("#contentItems").html(data.data.items)

            $("#totalInvoice").html(data.data.invoice.total)
        }
    })
}

loadInvoice()
