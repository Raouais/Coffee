import {Api} from '../Api/Api'

class CommandLine{

    constructor(id,quantity,command_id,product_id,dish_id){
        this.id = parseInt(id)
        this.quantity = parseInt(quantity)
        this.command_id = parseInt(command_id)
        this.product_id = parseInt(product_id)
        this.dish_id = parseInt(dish_id)
        this.api = new Api("http://localhost/Coffee/public/index.php?p=api.commandLine")
    }


    list(id){
        
    }


}


export {CommandLine}