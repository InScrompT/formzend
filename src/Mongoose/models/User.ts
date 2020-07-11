import mongoose from '..';

const userSchema = new mongoose.Schema({
    email: {
        type: String,
        required: true,
    },
    domains: [{
        type: mongoose.Schema.Types.ObjectId,
        ref: 'Domain'
    }],
});
const User = mongoose.model('User', userSchema);

export default User;
