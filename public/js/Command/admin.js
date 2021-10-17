import {CommandLine, lines} from '../Command/CommandLine'
import {Command} from '../Command/Command'

const socket = io('http://localhost:3000', { transports : ['websocket'] });

class AdminCommand {

    constructor(api){
        this.api = api;
        this.command = []
        this.line = []
        this.lines = new CommandLine()
        this.command = new Command()
        this.list()
    }

    async list(){
        const commands = await this.command.list()
        commands.forEach(c =>{
            this.addCommand(new Command(c.id,c.total,c.date,c.time,c.number,c.status,c.table_number,c.service_id))
        });
        const lines = await this.line.list()
        lines.forEach(l => {
            this.addCommandLine(new CommandLine(l.id,l.quantity,l.command_id,l.product_id,l.dish_id))
        })
    }

    addCommand(command){
        this.command.push(command)
        const t = document.getElementById("commands");
        this.command.forEach(e => {
            const p = document.createElement('p')
            p.innerText = e.number;
            console.log(e)
            t.appendChild(p)
        })
    }
}

new AdminCommand()
