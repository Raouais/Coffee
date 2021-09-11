import {Table} from './Table'
import {Wall} from './Wall'
import {Box} from './Box'

class Utils {


    constructor(livingRoom){
        this.livingRoom = livingRoom
        this.utils = []
        this.utilGet = null
        this.rect = null
        this.utilsBox = new Box(900,250,[]);
        this.utilsBox.makeCanvas(false)
    }

    generateUtils(){

        this.utilsBox.canvas.addEventListener("touchstart", e => {
            this.handleStart(e)
        }, false);

        // this.rect = getRect(this.utilsBox.canvas)

        let utilsBoxCtx = this.utilsBox.ctx

        const walls = [new Wall(-1,[30,60],[15,150]),new Wall(-1,[70,135],[15,75]), new Wall(-1,[180,120],[150,15]),new Wall(-1,[180,160],[75,15])]
        walls.forEach(w => this.utilsBox.addElement(w))

        const tables = [new Table(0,-1,[480,90],[100,100]),new Table(0,-1,[600,140],[50,50]),new Table(0,-1,[720,140],[100,100],""),new Table(0,-1,[810,165],[50,50],"")]
        tables.forEach(t => this.utilsBox.addElement(t))

        this.utilsBox.elements.forEach(e => this.utils.push(e))

        utilsBoxCtx.save()
        utilsBoxCtx.font = "bold 20px sans-serif"
        utilsBoxCtx.fillStyle = "#000"
        utilsBoxCtx.textAlign = "center"
        utilsBoxCtx.textBaseline = "middle"
        utilsBoxCtx.strokeStyle = "white"
        utilsBoxCtx.lineWidth = 5
        let centreX = this.utilsBox.width / 4
        let centreY = this.utilsBox.height - 50
        utilsBoxCtx.strokeText("Separateurs", centreX, centreY - 180)
        utilsBoxCtx.fillText("Separateurs", centreX, centreY - 180)

        utilsBoxCtx.fillRect(this.utilsBox.width/2, 0, 5, this.utilsBox.height)
        utilsBoxCtx.beginPath()

        utilsBoxCtx.strokeText("Tables", centreX * 3, centreY - 180);
        utilsBoxCtx.fillText("Tables", centreX * 3, centreY - 180);
        utilsBoxCtx.restore();
    }

    showUtils(insertBefore = null){
        if(insertBefore)
            document.body.insertBefore(this.utilsBox.canvas,insertBefore)
        else
            document.body.appendChild(this.utilsBox.canvas)
    }

    hideUtils(){
        document.body.removeChild(document.querySelector('canvas'))
    }

    
    defaultTable(){
        this.utils.forEach(t => {t.selected = false; t.setColor();})
    }

    showCord(x,y){
        console.log('cord: ', x + ', ' + y)
    }

    handleStart(e){
        e.preventDefault();
        let x
        let y
        let isTableTouched = false
        this.rect = this.utilsBox.getOffsetRect(this.utilsBox.canvas)
        for(let i = 0; i < e.changedTouches.length; i++) {
            x = parseInt(e.changedTouches[i].pageX) - this.rect.left;
            y = parseInt(e.changedTouches[i].pageY) - this.rect.top;
        }
        this.utils.forEach(t => {
            if(t.isTouchingMe(x,y)){
                if(t.selected){
                    this.defaultTable()
                    this.sendUtil(t)
                } else {
                    t.selected = true
                    t.setColor()
                    isTableTouched = true
                }
            } else {
                t.selected = false
                t.setColor()
            }
        })
        if(!isTableTouched){
            this.defaultTable()
        }
    }

    sendUtil(util){
        this.livingRoom.addElement( util.clone(), Object.getPrototypeOf(util).constructor.name === 'Table', true)
    }

}

export {Utils}