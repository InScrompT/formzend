import {Request, Response} from 'express';
import User from '../Mongoose/models/User';
import Domain from '../Mongoose/models/Domain';

export const handleForm = async (req: Request, res: Response) => {
    const {email} = req.params;
    const hostname = req.hostname;

    if (req.headers['content-type'] !== 'application/x-www-form-urlencoded') {
        return res.json({ message: 'nope' });
    }

    const user = await User.findOne({ email }).populate('domains');

    if (!user) {
        const newUser = await new User({ email }).save();
        const newDomain = await new Domain({ domain: hostname, owner: newUser._id }).save();

        return res.json({ newUser, newDomain });
    }

    const domain = await Domain.findOne({ domain: hostname, owner: user._id });

    if (!domain) {
        const newDomain = await new Domain({ domain: hostname, owner: user._id }).save();

        return res.json({ newDomain });
    }

    // @ts-ignore
    if (!domain.verified) {
        // Logic yet to be done
        return res.json({ message: 'Please verify your domain '});
    }

    return res.json({
        body: req.body
    });
};
