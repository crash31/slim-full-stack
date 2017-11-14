// Add Styling to the project
import 'bootstrap';

require('./scss/styles.scss');

class Log {
  writeLog() {
    console.log("Webpack is up and running!");
    console.log("But is the Webpack Dev Server?");
    console.log("BrowserSync is up and running!");
  }
}

const myLog = new Log;

myLog.writeLog();
