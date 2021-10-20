import firebase from "firebase/compat/app"
import "firebase/compat/auth"

const app = firebase.initializeApp({
  apiKey: "AIzaSyAQG3ylEix8aFDhedFSJrm10GVuBuY5E5o",
  authDomain: "iot-covid-patient-monitoring.firebaseapp.com",
  databaseURL: "https://iot-covid-patient-monitoring-default-rtdb.firebaseio.com",
  projectId: "iot-covid-patient-monitoring",
  storageBucket: "iot-covid-patient-monitoring.appspot.com",
  messagingSenderId: "598066107511",
  appId: "1:598066107511:web:cbfc683baf896956bca272"
})

export const auth = app.auth()

