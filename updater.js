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

    await shell(`git pull origin ${branch}`)
    // console.log(gitStatus)

    await shell(`npm run build`)
    // console.log(build)
  
    res.send({
        'status':200,
        'message':'OK'
    });
});

app.listen(process.env?.REPOSITORY_WATCHER_PORT ?? 3001, '127.0.0.1', () => {
    console.log(`Server started`)
});