import firebase from "firebase/compat/app"
import "firebase/compat/auth"

const app = firebase.initializeApp({
  apiKey: "Your API Key",
  authDomain: "Your Firebase auth domain",
  databaseURL: "Your Firebase Database URL",
  projectId: "Your Firebase project ID",
  storageBucket: "Your firebase storage bucket to use with firestore",
  messagingSenderId: "To enable messaging services like chatbots and social networking chatting applications",
  appId: "Unique AppID required to identify which app is accessing your firebase"
})

export const auth = app.auth()

