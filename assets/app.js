/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';
import { add } from '@hotwired/stimulus';

const $ = require('jquery');
// this "modifies" the jquery module: adding behavior to it
// the bootstrap module doesn't export/return anything
require('bootstrap');

//Sauvegarde projet par User

let addButtons = document.getElementsByClassName('project-add');


for (let i = 0; i < addButtons.length; i++) {
	addButtons[i].addEventListener('click', function addProject(e){
        e.preventDefault();
        let requestPath = e.currentTarget.href;
        console.log(requestPath);
    
        fetch(requestPath)
            .then((res) => res.json())
            .then(function (res) {
                let addButton = e.srcElement;
                  console.log(addButton);
                if (res.isOnProject) {
                    addButton.classList.remove('btn-primary');
                    addButton.classList.add('btn-success');
                    addButton.innerHTML = 'Projet enregistré !';
                } else {
                    addButton.classList.remove('btn-success');
                    addButton.classList.add('btn-primary');
                    addButton.innerHTML = 'Rejoindre le projet';
                }
            });
    });
}

function addProject(e) {
 
}
