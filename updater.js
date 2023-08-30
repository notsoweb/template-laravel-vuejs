/**
 * Dependencias
 */
const env = require('dotenv')
const util = require('util')
const express = require('express')
const { exec } = require('child_process');

/**
 * Iniciar objetos
 */
const app = express()
const shell = util.promisify(exec)

/**
 * Configuraciones
 */
env.config()
app.use(express.json());

/**
 * Rutas
 */
app.get('/', async(req, res) => {
    res.send({
        status: 200,
        message: 'Welcome'
    })
})

app.post('/update', async(req, res) => {
    let branch = process.env?.REPOSITORY_BRANCH ?? 'main'

    exec(`git pull origin ${branch}`, async(error, stdout, stderr) => {
      if (error) {
        console.log('queso1')
        console.error(`error: ${error.message}`);
        return;
      }
    
      if (stderr) {
        console.error(`stderr: ${stderr}`);

        await shell(`npm run build`)

        return;
      }
    });

    res.send({
        'status':200,
        'message':'Init process'
    });
});

app.listen(process.env?.REPOSITORY_WATCHER_PORT ?? 3001, '127.0.0.1', () => {
    console.log(`Server started`)
});