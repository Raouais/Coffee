class Box{

    constructor(width,height,elements = []){
        this.width = width
        this.height = height
        this.elements = elements
        this.nbElements = 0
        this.border = "3px solid gray"
        this.margin = "50px auto"
        this.display = "flex"
        this.backgroundColor = "#fff"
        this.ctx = null
        this.canvas =  null
    }

    addElement(element){
        element.ctx = this.ctx
        this.elements.push(element)
        this.showElements()
        this.nbElements++
    }

    removeElement(element){
        this.elements.splice(this.elements.indexOf(element),1);
        this.showElements()
        this.nbElements--
    }

    showElements(){
        this.ctx.clearRect(0,0,this.width,this.height)
        this.elements.forEach(e => e.draw())
    }

    makeCanvas(insert = false){
        let canvas = document.createElement('canvas')
        canvas.style.border = "3px solid gray"
        canvas.style.margin = "50px auto"
        canvas.style.display = "flex"
        canvas.style.backgroundColor = "#fff"
        canvas.width = this.width
        canvas.height = this.height
        this.canvas = canvas
        this.ctx = canvas.getContext('2d')
        if(insert)
            document.body.appendChild(canvas)
    }

    isNotAtLimitBox(x,y,element){
        if(element.format != undefined){
            if(element.format != "square"){
                x-= element.size[0] / 2
                y-= element.size[1] / 2
            }
        }
        if(x >= 0 && x + element.size[0] <= this.width && y >= 0 && y + element.size[1] <= this.height)
            return true
        return false
    }

    getOffsetRect(el){
        let rect = el.getBoundingClientRect();
    
        // add window scroll position to get the offset position
        let left   = rect.left   + window.scrollX;
        let top    = rect.top    + window.scrollY;
        let right  = rect.right  + window.scrollX;
        let bottom = rect.bottom + window.scrollY;
    
        // polyfill missing 'x' and 'y' rect properties not returned
        // from getBoundingClientRect() by older browsers
        let x
        let y
        if ( rect.x === undefined ) 
            x = left
        else 
            x = rect.x + window.scrollX;
    
        if ( rect.y === undefined ) 
            y = top;
        else 
            y = rect.y + window.scrollY;
    
        // width and height are the same
        let width  = rect.width;
        let height = rect.height;
    
        return { left, top, right, bottom, x, y, width, height };
    }
}

export {Box}