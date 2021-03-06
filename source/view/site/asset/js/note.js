(function() {

    let notes = document.querySelectorAll('.notes_item');

    function createInput(name, value, type = 'text')
    {
        let element = document.createElement('input');
        element.setAttribute('type', type);
        element.setAttribute('name', name);
        element.setAttribute('value', value);

        return element;
    }

    function showModalForEdit(note)
    {
        function getNoteContent(note)
        {
            let noteData = {
                'id': note.dataset.note_id,
                'content': null,
                'title': null,
                'color_id': note.dataset.note_color_id
            }

            let childrensNote = note.children;

            for (let children of childrensNote) {   

                if (children.className === 'notes_item_content')
                    noteData.content = children.innerText;

                if (children.className === 'notes_item_title')
                    noteData.title = children.innerText;
            }

            return noteData
        }

        function showModalWithContent(modalContainer, noteId, noteContent, noteTitle, noteColorId)
        {
            let modal =  document.querySelector(`.${modalContainer}`);

            let inputNoteId = createInput('id', noteId, 'hidden');

            let form = modal.querySelector('form');

            let colorsContainer = form.querySelector('.color_note');
            let color = colorsContainer.querySelector(`input[id="${noteColorId}"]`);
            
            let input = form.querySelector('input');
            let textarea = form.querySelector('textarea');
            
            function addContent()
            {
                input.value = noteTitle;
                textarea.value = noteContent;
                form.appendChild(inputNoteId);
                color.checked = true;
            }

            function removeContent()
            {
                form.reset();
            }
            
            addContent();

            modal.classList.add('modal_show');

            modal.addEventListener('click', (element) => {
                
                if (element.target.classList.contains(modalContainer)) {

                    removeContent();

                    modal.classList.remove('modal_show');
                }
            });
        }


        let noteData = getNoteContent(note);

        showModalWithContent('modal_container', noteData.id, noteData.content, noteData.title, noteData.color_id);
        
    }

    notes.forEach((note) => {

        note.addEventListener('click', (element) => {

            if (!element.target.classList.contains('notes_item_delete')) {

                showModalForEdit(note)
            }

        });

    });

})()