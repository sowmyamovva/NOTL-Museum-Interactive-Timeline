package testcase_12;

import org.junit.jupiter.api.AfterEach;
import org.junit.jupiter.api.BeforeEach;
import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.chrome.ChromeDriver;
import org.openqa.selenium.chrome.ChromeOptions;
import org.openqa.selenium.safari.SafariDriver;
import org.openqa.selenium.support.ui.ExpectedConditions;
import org.openqa.selenium.support.ui.WebDriverWait;

import java.time.Duration;

public class resetpasswordLinkLoginTest {
    WebDriver driver = null;

    @BeforeEach
    public void beforeAll(){
        driver = new SafariDriver();
        driver.navigate().to("https://badger-timeline.infinityfreeapp.com/public_html/views/pages/timeline");
    }

    @AfterEach
    public void aftertest(){
        driver.quit();
    }

    @Test
    public void test (){
        WebDriverWait wait = new WebDriverWait(driver, Duration.ofSeconds(5));
        WebElement element = wait.until(ExpectedConditions.elementToBeClickable(By.xpath("/html/body/div/div/div[1]/form/p[2]/a")));
        element.click();

    }

    public static void main (String[] args){

    }
}
