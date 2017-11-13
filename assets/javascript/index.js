// Add Styling to the project
require('../scss/styles.scss');

class Log {
  writeLog() {
    console.log("Webpack is up and running!");
    console.log("Babel is up and running es2015!");
  }
}

const myLog = new Log;

myLog.writeLog();
