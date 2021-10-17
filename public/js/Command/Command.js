import {Api} from '../Api/Api'

class Command{

    constructor(id,total,date,time,number,status,table_number,service_id){
        this.id = parseInt(id)
        this.date = date
        this.total = parseFloat(total)
        this.time = time
        this.number = parseInt(number)
        this.status = status
        this.table = parseInt(table_number)
        this.service = parseInt(service_id)
        this.api = new Api("http://localhost/Coffee/public/index.php?p=api.command");
    }

    async list(){
        const commands = await this.api.list()
        return commands.results;
    }

    async find(id){
        const command = await this.api.find(id)
        return command.results;
    }

    async update(command){
        const res = await this.api.update(command)
        return res;
    }

    async insert(id){
        const res = await this.api.insert(command)
        return res;
    }

    async delete(id){
        const res = await this.api.delete(id)
    }

}

export {Command}