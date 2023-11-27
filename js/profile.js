
const express = require('express');
const mongoose=require('mongoose')


const app = express();

app.use(express.json())


const url = 'mongodb://127.0.0.1:27017/myapp';



const connect=async()=>{
  try{
    await mongoose.connect(url)
    console.log("DB connection established")
  }
  catch(err){
    console.error(err)
    console.log('Connection Failed')
  }
}
connect();

const profileSchema=mongoose.Schema({
  Name:String,
  Email:String,
  DOB:String,
  Phone:Number
})

const User=mongoose.model('user',profileSchema);

app.post('/profile', async (req, res) => {
  // Get the user data from the request body
  const userData = req.body;

  try {
    // Use the model to create a new user
    const newUser = new User(userData);

    // Save the new user to the database
    await newUser.save();

    console.log('User Data:', newUser);
    res.status(201).send('User created successfully'); // Respond with a success status
  } catch (err) {
    console.error(err);
    res.status(500).send('Internal Server Error'); // Respond with an error status
  }
});

// Start the server
app.listen(3000, () => {
  console.log('Server started on port 3000');
});