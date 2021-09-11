import {Box} from './Box'
import { Table } from './Table'
import { Wall } from './Wall'

class Room {

    constructor(api){
        this.api = api;
        this.room = new Box(900, 600,[])
        this.room.makeCanvas(true)
        this.rect = null
        this.nbTables = 1
        this.elements = []
        this.addListeners()
        this.isElementSelected = false
        this.isModifying = false
        this.element = null
        this.getTables()
        this.getWalls()
    }

    async getTables(){
        this.api.setUrl(new Table().url)
        const tables = await this.api.list()
        tables.results.forEach(t => {
            this.addElement(new Table(parseInt(t.id),parseInt(t.number),[parseInt(t.position_x),parseInt(t.position_y)],[parseInt(t.size),parseInt(t.size)],t.format),false,false)
            this.nbTables++
        })
    }

    async getWalls(){
        this.api.setUrl(new Wall().url)
        const walls = await this.api.list()
        walls.results.forEach(t => {
            this.addElement(new Wall(parseInt(t.id),[parseInt(t.position_x),parseInt(t.position_y)],[parseInt(t.width),parseInt(t.height)]),false,false)
        })
    }

    addListeners(){
        this.room.canvas.addEventListener('touchmove', e => {
            this.handleMove(e)
        })
        this.room.canvas.addEventListener('touchstart', e => {
            this.handleStart(e)
        })
        this.room.canvas.addEventListener('touchend', e => {
            this.handleEnd(e)
        })
    }

    async addElement(element, isANewTable, hasCreated){
        if(isANewTable){
            element.number = this.nbTables
            this.nbTables++
        }
        if(hasCreated){
            element.status = "created"
        }
        this.room.addElement(element)
        this.elements.push(element)
    }

    removeElement(){
        if(this.element){
            this.element.status = "deleted"
            this.room.removeElement(this.element)
            this.element = null
        }
    }

    updateElements(){
        this.elements.forEach(async e => {
           this.api.setUrl(e.url)
            if(e.status === "modified"){
                await this.api.update(e.toJson())
                e.status = "default"
            } else if(e.status === "created"){
                await this.api.insert(e.toJson())
                e.status = "default"
            } else if(e.status === "deleted"){
                await this.api.delete(e.toJson())
            }
        })
    }

    handleMove(e){
        e.preventDefault();
        let x
        let y
        if(this.element){
            const center = this.element.getCenter()
            for(let i = 0; i < e.changedTouches.length; i++) {
                x = parseInt(e.changedTouches[i].pageX) - this.rect.left - center.x;
                y = parseInt(e.changedTouches[i].pageY) - this.rect.top - center.y;
                
                if(this.isModifying && this.isElementSelected && this.room.isNotAtLimitBox(x,y, this.element)){
                    this.element.setPosition(x,y)
                    this.room.showElements()
                }
            }
        }
    }

    handleStart(e){
        e.preventDefault();
        let x
        let y
        let isTableTouched = false
        this.rect = this.room.getOffsetRect(this.room.canvas)
        for(let i = 0; i < e.changedTouches.length; i++) {
            x = parseInt(e.changedTouches[i].pageX) - this.rect.left;
            y = parseInt(e.changedTouches[i].pageY) - this.rect.top;
        }
        this.elements.forEach(t => {
            if(t.isTouchingMe(x,y)){
                this.element = t
                t.selected = true
                t.setColor()
                isTableTouched = true
                this.isElementSelected = true
            } else {
                t.selected = false
                t.setColor()
            }
        })
        if(!isTableTouched){
            this.defaultTable()
        }
    }
    
    handleEnd(e){
        e.preventDefault()
        if(this.isElementSelected){
            this.isElementSelected = false
        }
    }

    defaultTable(){
        this.element = null
        this.elements.forEach(t => {
            if(t.status !== "deleted"){
                t.selected = false; 
                t.setColor();
            }
        })
    }


}

export {Room}