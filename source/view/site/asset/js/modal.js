(function(){

    function showModal(modalContainer)
    {
        var modal =  document.querySelector(`.${modalContainer}`);

        modal.classList.add('modal_show');

        modal.addEventListener('click', (e) => {

            classes = e.target.className.split(' ');

            if (classes[0] == modalContainer) {
                modal.classList.remove('modal_show');
            }

        });
    }

    var button = document.querySelector('.add_note_button');

    button.addEventListener('click', () => showModal('modal_container'));

})()