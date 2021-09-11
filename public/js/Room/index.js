import _, { update } from 'lodash'
import './style.css'
import {Utils} from './Utils'
import {Room} from './Room'
import { Api } from './Api';


const roomID = document.getElementById('room').value;


const api = new Api("http://localhost/Coffee/public/index.php?p=admin",roomID);

const room = new Room(api)
let isNotModifying = true

const utils = new Utils(room)
let isShowingUtils = false
utils.generateUtils()

const removeBtn = document.createElement('button')
removeBtn.className = 'btn btn-danger'
removeBtn.id = "remove"
removeBtn.textContent = "Supprimer"

const modify = document.getElementById('modify')
const utilBtn = document.getElementById('add')

function switchModifyBtn(){
    if(isNotModifying){
        modify.className = 'btn btn-success'
        modify.textContent = "Enregistrer"
        if(isShowingUtils){
            document.body.insertBefore(removeBtn,utils.utilsBox.canvas)
        } else {
            document.body.insertBefore(removeBtn,room.room.canvas)
        }
    } else {
        modify.className = 'btn btn-warning'
        modify.textContent = "Modifier"
        document.body.removeChild(document.getElementById('remove'))
    }
}

function switchUtil(){
    if(!isShowingUtils){
        utils.showUtils(room.room.canvas)
        isShowingUtils = true
        if(isNotModifying){
            switchModifyBtn()
            switchModify()
        }
    } else {
        utils.hideUtils()
        isShowingUtils = false
    }
}

function switchModify(){
    if(isNotModifying){
        room.isModifying = isNotModifying
        isNotModifying = false
    } else {
        room.isModifying = isNotModifying
        isNotModifying = true
        if(isShowingUtils){
            switchUtil()
        }
    }
}

modify.addEventListener('click', _ => {
    switchModifyBtn()
    switchModify()
    if(isNotModifying){
        room.updateElements()
    }
})


utilBtn.addEventListener('click', _ => {
    switchUtil()
})

removeBtn.addEventListener('click', _ => {
    room.removeElement()
})



