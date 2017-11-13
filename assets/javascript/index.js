// Add Styling to the project
require('../scss/styles.scss');

class Log {
  writeLog() {
    console.log("Webpack is up and running!");
    console.log("Babel is up and running es2015!");
    console.log("Testing. 1. 2. 3.");
  }
}

const myLog = new Log;

myLog.writeLog();
