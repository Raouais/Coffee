import _ from 'lodash'


class Table {
        
    constructor(id,number,position = [10,10], size = [100,100], format = "square"){
        this.id = id;
        this.number = number
        this.status = "default";
        this.position = position
        this.radius = size[0] / 2
        this.format = format
        this.ctx = null
        this.size = size
        this.selected = false
        this.defaultColor = "#000"
        this.selectedColor = "#1E90FF" // dodger blue
        this.margeColor = "#fff"
        this.color = this.defaultColor
        this.amIATable = true;
        this.url = "http://localhost/Coffee/public/index.php?p=admin.board"
    }

    toJson(){
        return {id:this.id,number:this.number,position_x:this.position[0],position_y:this.position[1],format:this.format,size:this.size[0]}
    }

    getCenter(){
        let x = 0
        let y = 0
        if(this.format === "square"){
            x = this.size[0] /2
            y = this.size[1] /2
        }
        return {x,y}
    }
    
    setPosition(x,y){
        if(this.status === "default")
            this.status = "modified"
        this.position[0] = x
        this.position[1] = y
    }

    setColor(){
        if(this.selected)
            this.color = "#1E90FF" // dodger blue
        else
            this.color = "#000"
        this.draw()
    }
    
    draw(){
        if(this.status !== "deleted"){
            if(this.format === "square"){
                this.drawSquare()
            } else {
                this.drawCircle()
            }
        }
    }

    drawCircle(){
        this.ctx.save()
        this.ctx.fillStyle = this.color
        this.ctx.arc(this.position[0], this.position[1], this.radius, 0, Math.PI*2, false)
        this.ctx.fill()
        this.ctx.beginPath()
        this.ctx.restore()
        this.ctx.save()
        this.ctx.fillStyle = this.margeColor
        this.ctx.arc(this.position[0], this.position[1], this.radius - 4, 0, Math.PI*2, true)
        this.ctx.fill()
        if(this.number >= 0){
            this.ctx.font = "bold 30px sans-serif"
            this.ctx.fillStyle = "#000"
            this.ctx.textAlign = "center"
            this.ctx.textBaseline = "middle"
            this.ctx.strokeStyle = "white"
            this.ctx.strokeText(this.number, this.position[0], this.position[1])
            this.ctx.fillText(this.number, this.position[0], this.position[1])
        }
        this.ctx.beginPath()
        this.ctx.restore()
    }

    drawSquare(){
        this.ctx.save()
        this.ctx.fillStyle = this.color
        this.ctx.fillRect(this.position[0],this.position[1],this.size[0],this.size[1])
        this.ctx.fillStyle = this.margeColor
        this.ctx.fillRect(this.position[0] + 3, this.position[1] + 3, this.size[0] - 6, this.size[1] - 6)
        if(this.number >= 0){
            this.ctx.font = "bold 30px sans-serif"
            this.ctx.fillStyle = "#000"
            this.ctx.textAlign = "center"
            this.ctx.textBaseline = "middle"
            this.ctx.strokeStyle = "white"
            this.ctx.strokeText(this.number, this.position[0] + this.size[0]/2, this.position[1] + this.size[1]/2 )
            this.ctx.fillText(this.number, this.position[0] + this.size[0]/2, this.position[1] + this.size[1]/2 )
        }
        this.ctx.beginPath()
        this.ctx.restore()
    }


    isTouchingMe(x,y){
        let isTouching = false
        if(this.format == "square"){
            if((x >= this.position[0] && x <= this.position[0] + this.size[0]) && (y >= this.position[1] && y <= this.position[1] + this.size[1])){
                isTouching = true
            }
        } else {
            let positionX = this.position[0] - this.radius
            let positionY = this.position[1] - this.radius
            if((x >= positionX && x <= positionX + this.size[0]) && (y >= positionY && y <= positionY + this.size[1])){
                isTouching = true
            }
        }
        return isTouching
    }
    
    clone(){
        return _.cloneDeep(this)
    }
}


export {Table}