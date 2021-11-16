(function() {

    let notes = document.querySelectorAll('.notes_item');

    function showModalForEdit(element)
    {
        function showModalWithContent(modalContainer, content, title)
        {
            var modal =  document.querySelector(`.${modalContainer}`);
    
            modal.classList.add('modal_show');

            // ver maneira de passar o content e o title para o modal
    
            modal.addEventListener('click', (element) => {

                if (element.target.classList.contains(modalContainer))
                    modal.classList.remove('modal_show');
    
            });
        }

        let childrens = element.children;

        for (let children of childrens) {

            let content = children.className === 'notes_item_content' ? children.innerText : null;
            let title = children.className === 'notes_item_title' ? children.innerText : null;

            showModalWithContent('modal_container', content, title);
        }
    }

    notes.forEach((element) => {

        element.addEventListener('click', () => showModalForEdit(element));

    });

})()