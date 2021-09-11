import _ from "lodash"

class Wall{

    constructor(id,position = [10,10], size = [100,100]){
        this.id = id;
        this.ctx = null
        this.position = position
        this.status = "default";
        this.size = size
        this.selected = false
        this.color = "#000"
        this.url = "http://localhost/Coffee/public/index.php?p=admin.wall"

    }

    toJson(){
        return {id:this.id,position_x:this.position[0],position_y:this.position[1],width:this.size[0],height:this.size[1]}
    }

    getCenter(){
        let x = this.size[0] /2
        let y = this.size[1] /2
        return {x,y}
    }
    

    setPosition(x,y){
        if(this.status !== "modified" && this.status !== "created")
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
        this.ctx.save()
        this.ctx.fillStyle = this.color
        this.ctx.fillRect(this.position[0],this.position[1],this.size[0],this.size[1])
        this.ctx.beginPath()
        this.ctx.restore()
    }

    isTouchingMe(x,y){
        if((x >= this.position[0] && x <= this.position[0] + this.size[0]) && (y >= this.position[1] && y <= this.position[1] + this.size[1])){
            return true
        }
        return false
    }

    clone(){
        return _.cloneDeep(this)
    }
}

export {Wall}