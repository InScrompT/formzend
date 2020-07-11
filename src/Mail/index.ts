import * as dotenv from 'dotenv';
import * as nodemailer from 'nodemailer';

dotenv.config();
const transport = nodemailer.createTransport({
    // @ts-ignore
    host: process.env.MAIL_HOST,
    port: process.env.MAIL_PORT,
    auth: {
        user: process.env.MAIL_USER,
        pass: process.env.MAIL_PASS
    }
});

export default transport;
