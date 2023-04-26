package testcase_1;
import org.junit.jupiter.api.*;
import org.openqa.selenium.*;
import org.openqa.selenium.chrome.ChromeDriver;
import org.openqa.selenium.support.ui.ExpectedConditions;
import org.openqa.selenium.support.ui.WebDriverWait;
import java.time.Duration;



public class VisitNowTesting {
WebDriver driver = null;

@BeforeEach
public void beforeTesting(){
    System.setProperty("webdriver.chrome.driver", "./chromedriver");
    driver = new ChromeDriver();
    driver.get("https://badger-timeline.infinityfreeapp.com/public_html/");
}

@AfterEach
public void aftertest(){
    driver.quit();
}

@Test
public void test (){
    WebDriverWait wait = new WebDriverWait(driver, Duration.ofSeconds(5));
    WebElement element = wait.until(ExpectedConditions.elementToBeClickable(By.xpath("/html/body/div/div[1]/div[1]/a/button")));

    element.click();

}




    public static void main (String[] args){
    }

}
