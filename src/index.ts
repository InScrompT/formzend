import {join} from 'path';
import * as cors from 'cors';
import * as dotenv from 'dotenv';
import * as express from 'express';
import routes from './Routes';

dotenv.config();
const app: express.Application = express();

app.set('view engine', 'twig');
app.set('views', join(__dirname, '../resources/views'));

app.use(cors());
app.use(express.urlencoded({ extended: true }));
app.use(routes);

const PORT = process.env.PORT;
app.listen(PORT, () => console.log('Listening on port', PORT));
