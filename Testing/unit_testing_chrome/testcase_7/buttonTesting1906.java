package testcase_7;

import org.junit.jupiter.api.AfterAll;
import org.junit.jupiter.api.BeforeAll;
import org.junit.jupiter.api.Test;
import org.openqa.selenium.By;
import org.openqa.selenium.WebDriver;
import org.openqa.selenium.WebElement;
import org.openqa.selenium.chrome.ChromeDriver;
import org.openqa.selenium.interactions.Actions;
import org.openqa.selenium.support.ui.ExpectedConditions;
import org.openqa.selenium.support.ui.WebDriverWait;

import java.time.Duration;

public class buttonTesting1906 {
    WebDriver driver = null;

    @BeforeAll
    public void beforeAll(){
        System.setProperty("webdriver.chrome.driver", "./chromedriver");
        driver = new ChromeDriver();
        driver.get("https://badger-timeline.infinityfreeapp.com/public_html/views/pages/timeline");
    }

    @AfterAll
    public void aftertest(){
        driver.quit();
    }

    @Test
    public void test (){
        //WebDriverWait wait = new WebDriverWait(driver, Duration.ofSeconds(10));
        WebElement element = driver.findElement(By.xpath("//*[name()='svg']//*[name()='circle' and @id ='9000_BC']"));
        new WebDriverWait(driver, Duration.ofSeconds(10)).until(ExpectedConditions.elementToBeClickable(By.xpath("//*[name()='svg']//*[name()='circle' and @id ='1906']")));
        Actions builder = new Actions(driver);
        builder.moveToElement(element).click(element).build().perform();

    }

    public static void main (String[] args) {
    }
}
