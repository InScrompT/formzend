import * as mongoose from 'mongoose';
import * as dotenv from 'dotenv';

if (process.env.NODE_ENV !== 'production') {
    dotenv.config();
}

const CONNECTION_URL: string = 'mongodb://'
    + process.env.DB_USER + ':'
    + process.env.DB_PASS + '@'
    + process.env.DB_HOST + ':'
    + process.env.DB_PORT + '/'
    + process.env.DB_NAME;
mongoose.connect(CONNECTION_URL, { useNewUrlParser: true, useUnifiedTopology: true });

export default mongoose;
