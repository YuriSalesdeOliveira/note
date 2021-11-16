(function(){

    function showModal(modalContainer)
    {
        var modal =  document.querySelector(`.${modalContainer}`);

        let form = modal.querySelector('form');

        let input = form.querySelector('input');
        let textarea = form.querySelector('textarea');

        (function removeContent()
        {
            input.value = null;
            textarea.value = null;
        })()

        modal.classList.add('modal_show');

        modal.addEventListener('click', (e) => {

            if (e.target.classList.contains(modalContainer)) {

                modal.classList.remove('modal_show');
            }
        });
    }

    var button = document.querySelector('.add_note_button');

    button.addEventListener('click', () => showModal('modal_container'));

})()