(function () {
    let buttons = document.querySelectorAll('[data-form_id]')

    let forms = document.querySelectorAll('form')

    forms.forEach((form) => { form.style.display = 'none' })

    buttons.forEach((button) => {

        let form_id = button.getAttribute('data-form_id')

        let form = document.getElementById(form_id)
        
        button.addEventListener('click', function () {
            forms.forEach((form) => { form.style.display = 'none' })
            form.style.display = 'flex'
        })
    })
})()