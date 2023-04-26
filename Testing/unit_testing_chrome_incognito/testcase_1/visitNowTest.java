package testcase_1;
import org.junit.jupiter.api.*;
import org.openqa.selenium.*;
import org.openqa.selenium.chrome.ChromeDriver;
import org.openqa.selenium.chrome.ChromeOptions;
import org.openqa.selenium.support.ui.ExpectedConditions;
import org.openqa.selenium.support.ui.WebDriverWait;
import java.time.Duration;

public class visitNowTest {
    WebDriver driver = null;

    @BeforeEach
    public void beforeTesting(){
        System.setProperty("webdriver.chrome.driver", "./chromedriver");
        ChromeOptions co = new ChromeOptions();
        co.addArguments("incognito");
        driver = new ChromeDriver(co);
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
}
