import mongoose from '..';

const domainSchema = new mongoose.Schema({
    owner: {
        type: mongoose.Schema.Types.ObjectId,
        ref: 'User',
    },
    domain: {
        type: String,
        required: true,
    },
    verified: {
        type: Boolean,
        default: false,
    },
});
const Domain = mongoose.model('Domain', domainSchema);

export default Domain;
