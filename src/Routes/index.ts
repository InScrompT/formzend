import { Router } from 'express';
import * as formController from '../Controller/form-controller';

const route: Router = Router();

route.get('/');

route.post('/:email', formController.handleForm);

export default route;
